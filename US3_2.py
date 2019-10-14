from selenium import webdriver
import time
import imaplib
import email

"""3:2 (Both) User can reset password on a password reset page that is linked from the login page."""


IP = '10.178.40.49'

# Variables for email scrapping
user = 'testing.mjm.services@gmail.com'
password = ''
imap_url = 'imap.gmail.com'

new_password = 'TTest1234@'

# Going to url to generate key.
url = 'http://' + IP + '/branch/MJM-Tax-Services/login.php'
# Opening web browser, for user gratification
browser = webdriver.Chrome()
browser.get(url)


pass_reset = browser.find_element_by_id("pass_reset")
pass_reset.click()


email_input = browser.find_element_by_id("email")
email_input.send_keys(user)

email_btn = browser.find_element_by_id("emailBtn")
email_btn.click()

# Closing browser
browser.quit()

# Start of the email scrapping; Function to extract body from email


def get_body(msg):
    if msg.is_multipart():
        return get_body(msg.get_payload(0))
    else:
        return msg.get_payload(None, True)


# Connecting to server and logging in
con = imaplib.IMAP4_SSL(imap_url)
con.login(user, password)

# Searching through inbox for email
con.select('INBOX')
result, data = con.search(None, '(FROM "testing.mjm.services@gmail.com")')

# Searching for the newest email
email_list = data[0].split()
newest = email_list[-1]

# Converting email to string from bytes
result, data = con.fetch(newest, '(RFC822)')
raw = email.message_from_bytes(data[0][1])

# Taking message in raw form and splitting it into an array
email_msg = get_body(raw)
email_array = email_msg.split()

# Decoding array from bytes to string
email_key = email_array[8][:-1].decode("utf-8")

# Closing connection to email
con.logout()

# Creating url for next part of test
url2 = "http://" + email_key

# Opening web browser, for user gratification
browser = webdriver.Chrome()
browser.get(url2)

# Finding password element and inputting new password
password_reset = browser.find_element_by_id("pass")
password_reset.send_keys(new_password)

password_Verif_reset = browser.find_element_by_id("passVerif")
password_Verif_reset.send_keys(new_password)

# Submitting new password
submit = browser.find_element_by_id("submit")
submit.click()

# Finding by id username input
username_test = browser.find_element_by_id("username")
username_test.send_keys(user)

# Finding by id username password
password_test = browser.find_element_by_id("pass")
password_test.send_keys(new_password)

# Finding by id button to submit login
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
    print("Test passed.")
elif (url1 == url3):
    print("Tested failed using " + user + ". Username or password invalid.")
else:
    print("Test failed using " + user + ".")

# Closing browser
browser.quit()
