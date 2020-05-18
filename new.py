def add_message(uuid):
    content = request.json
    try:
     print(content['mytext'])
    except:print(content)
    return jsonify({"uuid":uuid})
if __name__ == '__main__':
    app.run(debug=True)