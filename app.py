from flask import Flask, render_template, request, jsonify
import mysql.connector

app = Flask(__name__)


def get_db():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="2003",
        database="my_store"
    )


@app.route("/")
def home():

    db = get_db()
    cursor = db.cursor(dictionary=True)

    cursor.execute("SELECT * FROM products")
    products = cursor.fetchall()

    cursor.close()
    db.close()

    return render_template("ali.html", products=products)


@app.route("/place_order", methods=["POST"])
def place_order():

    data = request.get_json()

    name = data.get("customer_name") or data.get("name")
    phone = data.get("phone")
    address = data.get("address")
    cart = data.get("cart", [])

    if not name or not phone or not address or not cart:
        return jsonify({
            "success": False,
            "message": "بيانات الطلب ناقصة"
        }), 400

    db = get_db()
    cursor = db.cursor()

    try:

        # 1. إضافة العميل
        cursor.execute(
            """
            INSERT INTO customers
            (customer_name, phone, address)
            VALUES (%s, %s, %s)
            """,
            (name, phone, address)
        )

        customer_id = cursor.lastrowid

        # 2. حساب الإجمالي
        total_amount = sum(
            float(item["price"]) * int(item["quantity"])
            for item in cart
        )

        # 3. إنشاء عملية البيع
        cursor.execute(
            """
            INSERT INTO sales
            (customer_id, total_amount)
            VALUES (%s, %s)
            """,
            (customer_id, total_amount)
        )

        sale_id = cursor.lastrowid

        # 4. إضافة تفاصيل المنتجات
        for item in cart:

            cursor.execute(
                """
                INSERT INTO sale_details
                (sale_id, product_id, quantity, unit_price)
                VALUES (%s, %s, %s, %s)
                """,
                (
                    sale_id,
                    item["id"],
                    item["quantity"],
                    item["price"]
                )
            )

        # 5. حفظ كل العمليات
        db.commit()

        return jsonify({
            "success": True,
            "sale_id": sale_id
        })

    except Exception as e:

        db.rollback()

        return jsonify({
            "success": False,
            "message": str(e)
        }), 500

    finally:

        cursor.close()
        db.close()


if __name__ == "__main__":
    app.run(debug=True)
