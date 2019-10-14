from selenium import webdriver
import time
import imaplib
import email

"""3:1 (Both) User can login with username or email address on the login page."""


IP = '10.178.40.49'

Client_username = "Test1234@"
Client_email = "testing.mjm.services@gmail.com"
Client_password = "TTest1234@"

Admin_username = "Admin1234@"
Admin_email = "testadmin@gmail.com"
Admin_password = "Admin1234@"

Fail_username = "4753toigqyrb"
Fail_email = "tesingfailedemail@gmail.com"
Fail_password = "76ougywbfqo"


def function(creds, creds_pass):
    # Going to url to generate key.
    url = 'http://' + IP + '/branch/MJM-Tax-Services/login.php'
    # Opening web browser, for user gratification
    browser = webdriver.Chrome()
    browser.get(url)

    # Finding by id username input
    username_test = browser.find_element_by_id("username")
    # passing creds to run function multpile times
    username_test.send_keys(creds)

    # Finding by id username password
    password_test = browser.find_element_by_id("pass")
    password_test.send_keys(creds_pass)

    # Finding by id button to generate key
    generate = browser.find_element_by_id("submit")
    generate.click()

    # url1 current url in browser
    url1 = browser.current_url
    # url2 correct url
    url2 = "http://10.178.40.49/branch/MJM-Tax-Services/home.php"
    # url2 incorrect url
    url3 = "http://10.178.40.49/branch/MJM-Tax-Services/login.php"

    # If statement to compare urls
    if (url1 == url2):
        print("Test passed using " + creds + ".")
    elif (url1 == url3):
        print("Failed to sign in " + creds + ". Username or password invalid.")
    else:
        print("Failed to sign in " + creds + ".")

    # Closing browser
    browser.quit()


# Admin username testing
function(Admin_username, Admin_password)

# Admin email testing
function(Admin_email, Admin_password)

# Client username testing
function(Client_username, Client_password)

# Client email testing
function(Client_email, Client_password)

# Fail username testing
function(Fail_username, Fail_password)

# Fail email testing
function(Fail_email, Fail_password)
