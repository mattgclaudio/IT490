# Before running the code, you will have to manually
# install a number of the packages below, and probably configure the others in the interpreter.

# First installation.

# This should be run from the python console inside your IDE

# pip install yahoo_fin requests_html
#   in the settings > project interpreter > + : yahoo-fin matplotlib and alpaca-trade-api


from yahoo_fin.stock_info import *
import pandas as pd
import matplotlib.pyplot as plt
import alpaca_trade_api as tradeapi

plt.style.use('bmh')
pd.options.display.width = 0

# Old function, good use of .loc though.
# def wholegrp():
#     eggsalad = get_day_most_active().loc[:, ["Symbol", "% Change"]]
#     veggie = eggsalad.sort_values(by=['% Change'], ascending=False)
#     return veggie[:30]

# call the get data method with just Apple, returns 7000 rows back to 1980
jackal = get_data('AAPL')
# make a plot with matplotlib
plt.figure(figsize=(16, 8))
plt.title("Long term Trend")
plt.plot(jackal['close'])
plt.xlabel('Date')
plt.ylabel('Close Price')
# Show the plot
# plt.show()

# print(jackal)
# ticker, start, end , etc.

# ticker = 'AAPL'
# Other functions in yahoo_fin
# # print(get_earnings(ticker))
#
# # print(get_live_price(ticker))
#
# # print(get_income_statement(ticker, yearly=True))



# Keys that have already been generated on the alpaca website for use here, I am not
# sure we can generate new user accounts in a PHP/Python script, although we can control
# EXISTING accounts with the keys below. url links to the paper i.e. practice account.
key = "PKOWHBTVHXBZXFDOY8YU"
sec = "sNoRCTp9cK6Y8k4jerXijbPeY15S3MkxcKE4sHGt"

url = "https://paper-api.alpaca.markets"
# api connection
api = tradeapi.REST(key, sec, url, api_version='v2')


def testorder(tkrzero):
    testcast = 2000
    highprice = get_data(tkrzero)['high'][-1]
    limit = int(testcast / highprice)

    try:
        order = api.submit_order(symbol=tkrzero,
                                 qty=limit,
                                 side="buy",
                                 type="market",
                                 time_in_force="gtc")

    finally:
        print("done")

# Deliverable 1. keep track of cash account & porfolio positions for users

# this should list any positions (stocks ) that they already
# have bought
# api.list_assets()

# We can use these two to implement the users having a
# number of stocks that they are tracking.
# api.create_watchlist()
# api.add_to_watchlist()


larp = api.get_account()

# account variable has a number of fields, including cash,
# equity, id, buying power, etc. i cant just access it like a
# python dictionary, the only way i have gotten it to work is with
# this .__getattr__('<attribute>') method

print(larp.__getattr__('cash'))
