from flask import Flask, render_template
import os

app = Flask(__name__)  # Flask secara otomatis mencari folder templates di lokasi default

@app.route('/')
def index():
    return render_template('login.html') 
    
@app.route('/tutorial')
def view_tutorial():
    return render_template('tutorial.html') 
@app.route('/admin')
def view_admin():
    return render_template('admin.html') 
@app.route('/artikel')
def view_artikel():
    return render_template('artikel.html') 
@app.route('/artikel1')
def view_artikel1():
    return render_template('artikel1.html') 
@app.route('/artikel2')
def view_artikel2():
    return render_template('artikel2.html') 
@app.route('/artikel3')
def view_artikel3():
    return render_template('artikel3.html') 
@app.route('/backend')
def view_backend():
    return render_template('backend.html') 
@app.route('/buku')
def view_buku():
    return render_template('buku.html')
@app.route('/Database')
def view_Database():
    return render_template('Database.html') 
@app.route('/frontend')
def view_frontend():
    return render_template('frontend.html') 
@app.route('/home')
def view_home():
    return render_template('home.html') 
@app.route('/kontak')
def view_kontak():
    return render_template('kontak.html') 
@app.route('/ruangbaca')
def view_ruangbaca():
    return render_template('ruangbaca.html') 
@app.route('/tentang')
def view_tentang():
    return render_template('tentang.html') 
if __name__ == '__main__':
    app.run(debug=True)
