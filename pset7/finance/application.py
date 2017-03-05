from cs50 import SQL
from flask import Flask, flash, redirect, render_template, request, session, url_for
from flask_session import Session
from passlib.apps import custom_app_context as pwd_context
from tempfile import gettempdir

from helpers import *

# configure application
app = Flask(__name__)

# ensure responses aren't cached
if app.config["DEBUG"]:
    @app.after_request
    def after_request(response):
        response.headers["Cache-Control"] = "no-cache, no-store, must-revalidate"
        response.headers["Expires"] = 0
        response.headers["Pragma"] = "no-cache"
        return response

# custom filter
app.jinja_env.filters["usd"] = usd

# configure session to use filesystem (instead of signed cookies)
app.config["SESSION_FILE_DIR"] = gettempdir()
app.config["SESSION_PERMANENT"] = False
app.config["SESSION_TYPE"] = "filesystem"
Session(app)

# configure CS50 Library to use SQLite database
db = SQL("sqlite:///finance.db")

@app.route("/")
@login_required
def index():
    rows = db.execute("Select stock, quantity from portfolio where user_id = :user_id", user_id = session["user_id"])
    cash = db.execute("Select cash from users where id = :user_id", user_id = session["user_id"])
    for n in rows:
        n["price"]=usd(lookup(n["stock"])["price"]*n["quantity"])
    return render_template("index.html", rows=rows, cash=usd(cash[0]["cash"]))
    

@app.route("/buy", methods=["GET", "POST"])
@login_required
def buy():
    """Buy shares of stock."""
    rows = db.execute("SELECT cash FROM users WHERE id = :id", id=session["user_id"])
    if request.method == "POST":
        if not request.form.get("ticker") or not request.form.get("quantity"):
            return apology("must provide ticker and quantity")
        elif str(int(float(request.form.get("quantity"))))!=request.form.get("quantity"):
            return apology("Please enter an integer quantity for purchase")
        elif int(request.form.get("quantity"))<=0:
            return apology("Please provide a positive integer amount of shares to buy")
        elif lookup(request.form.get("ticker"))==None:
            return apology("Enter a valid stock ticker")
        elif lookup(request.form.get("ticker"))["price"]*int(request.form.get("quantity"))>rows[0]["cash"]:
            return apology("Not enough cash to purchase that many shares")
        else: 
            db.execute("UPDATE users SET cash = cash - :price*:quantity WHERE id = :id", price=lookup(request.form.get("ticker"))["price"], quantity = int(request.form.get("quantity")), id=session["user_id"])
            db.execute("INSERT INTO transactions (user_id, stock, quantity, transaction_type, stock_price) VALUES (:user_id, :stock, :quantity, :transaction_type, :stock_price)", user_id = session["user_id"], stock = request.form.get("ticker").upper(), quantity = int(request.form.get("quantity")), transaction_type = 'Buy', stock_price = lookup(request.form.get("ticker"))["price"])
            if len(db.execute("SELECT * FROM portfolio where stock = :stock and user_id = :user_id", stock = request.form.get("ticker").upper(), user_id = session["user_id"])) > 0:
                db.execute("UPDATE portfolio SET quantity = quantity + :quantity WHERE user_id = :user_id and stock = :stock", user_id = session["user_id"], stock = request.form.get("ticker").upper(), quantity = int(request.form.get("quantity")))
            else:
                db.execute("INSERT INTO portfolio (user_id, stock, quantity) VALUES(:user_id, :stock, :quantity)", user_id = session["user_id"], stock = request.form.get("ticker").upper(), quantity = int(request.form.get("quantity")))
            return redirect(url_for("index"))
    else:
        return render_template("buy.html")
    

@app.route("/history")
@login_required
def history():
    """Show history of transactions."""
    rows = db.execute("SELECT * FROM transactions WHERE user_id = :user_id", user_id=session["user_id"])
    return render_template("history.html", rows=rows)

@app.route("/login", methods=["GET", "POST"])
def login():
    """Log user in."""

    # forget any user_id
    session.clear()

    # if user reached route via POST (as by submitting a form via POST)
    if request.method == "POST":

        # ensure username was submitted
        if not request.form.get("username"):
            return apology("must provide username")

        # ensure password was submitted
        elif not request.form.get("password"):
            return apology("must provide password")

        # query database for username
        rows = db.execute("SELECT * FROM users WHERE username = :username", username=request.form.get("username"))

        # ensure username exists and password is correct
        if len(rows) != 1 or not pwd_context.verify(request.form.get("password"), rows[0]["hash"]):
            return apology("invalid username and/or password")

        # remember which user has logged in
        session["user_id"] = rows[0]["id"]

        # redirect user to home page
        return redirect(url_for("index"))

    # else if user reached route via GET (as by clicking a link or via redirect)
    else:
        return render_template("login.html")

@app.route("/logout")
def logout():
    """Log user out."""

    # forget any user_id
    session.clear()

    # redirect user to login form
    return redirect(url_for("login"))

@app.route("/password", methods=["GET", "POST"])
@login_required
def password():
    """Change Password."""
    if request.method == "POST":
        rows = db.execute("Select * from users where id = :user_id",user_id=session["user_id"])
        if len(request.form.get("old_password"))==0 or len(request.form.get("password"))==0:
            return apology("Please populate the password fields")
        elif not pwd_context.verify(request.form.get("old_password"), rows[0]["hash"]):
            return apology("Old Password Incorrect")
        elif request.form.get("password")!=request.form.get("password_validate"):
            return apology("New Passwords Don't Match")
        else: 
            db.execute("UPDATE users SET hash = :hash WHERE id = :id", id=session["user_id"], hash=pwd_context.encrypt(request.form.get("password")))
            return redirect(url_for("index"))
    else: 
        return render_template("password.html")

@app.route("/quote", methods=["GET", "POST"])
@login_required
def quote():
    """Get stock quote."""
    if request.method == "POST":
        rows = lookup(request.form.get("ticker"))
        return render_template("quoted.html", rows=rows)
    else: 
        return render_template("quote.html")

@app.route("/register", methods=["GET", "POST"])
def register():
    """Register user."""
    if request.method == "POST":

        # ensure username was submitted
        if not request.form.get("username"):
            return apology("must provide username")

        # ensure password was submitted
        elif not request.form.get("password"):
            return apology("must provide password")
        
        elif request.form.get("password")!=request.form.get("password_validate"):
            return apology("passwords do not match")
            
        else: 
            rows = db.execute("INSERT INTO users (username, hash) VALUES (:username, :hash)",  username=request.form.get("username"), hash=pwd_context.encrypt(request.form.get("password")))
            return redirect(url_for("index"))
        
        
            
    else: return render_template("register.html")
    
     

@app.route("/sell", methods=["GET", "POST"])
@login_required
def sell():
    """Sell shares of stock."""
    if request.method == "POST":
        rows = db.execute("SELECT quantity FROM portfolio WHERE user_id = :user_id and stock=:stock", user_id=session["user_id"], stock=request.form.get("ticker").upper())
        if not request.form.get("ticker") or not request.form.get("quantity"):
            return apology("must provide ticker and quantity")
        elif str(int(float(request.form.get("quantity"))))!=request.form.get("quantity"):
            return apology("Please enter an integer quantity for sale")
        elif int(request.form.get("quantity"))<=0:
            return apology("Please provide a positive amount of shares to sell")
        elif lookup(request.form.get("ticker").upper())==None or len(rows)==0:
            return apology("Enter a valid stock ticker for shares in your portfolio")
        elif int(request.form.get("quantity"))>int(rows[0]["quantity"]):
            return apology("You're trying to sell more shares than you have!")
        else: 
            db.execute("UPDATE users SET cash = cash + :price*:quantity WHERE id = :id", price=lookup(request.form.get("ticker"))["price"], quantity = int(request.form.get("quantity")), id=session["user_id"])
            db.execute("INSERT INTO transactions (user_id, stock, quantity, transaction_type, stock_price) VALUES (:user_id, :stock, :quantity, :transaction_type, :stock_price)", user_id = session["user_id"], stock = request.form.get("ticker").upper(), quantity = int(request.form.get("quantity")), transaction_type = 'Sell', stock_price = lookup(request.form.get("ticker"))["price"])
            if int(rows[0]["quantity"])==int(request.form.get("quantity")):
                db.execute("DELETE FROM portfolio WHERE user_id = :user_id and stock = :stock", user_id = session["user_id"], stock = request.form.get("ticker").upper())
            else:
                db.execute("UPDATE portfolio SET quantity = quantity - :quantity WHERE user_id = :user_id and stock = :stock", user_id = session["user_id"], stock = request.form.get("ticker").upper(), quantity = int(request.form.get("quantity")))
            return redirect(url_for("index"))
    else:
        return render_template("sell.html")
