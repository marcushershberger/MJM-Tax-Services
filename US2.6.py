from selenium import webdriver
import time
import imaplib
import email

"""2:6 (Admin) User can edit content in text-box on the invite.php page.
This content can then be sent to the client via email. The content will be
generated upon the activation of the generate key button, this allows for
the content and the key to appear in the text-box."""


IP = '10.178.40.49'

# Variables for email scrapping
user = 'testing.mjm.services@gmail.com'
password = ''
imap_url = 'imap.gmail.com'

# Going to url to generate key.
url = 'http://' + IP + '/branch/MJM-Tax-Services/invite.php'
# Opening web browser, for user gratification
browser = webdriver.Chrome()
browser.get(url)

# Finding by id drop down list and selecting Client
accountSelection = browser.find_element_by_id("accountSelection")
accountSelection.send_keys("Client")

# Finding by id button to generate key
generate = browser.find_element_by_id("generateKeyBtn")
generate.click()

# Entering email into email field
emailVar = browser.find_element_by_id("email")
emailVar.send_keys(user)

# Findiing message field and entering a string into the field
message = browser.find_element_by_id("message")
message.send_keys(" Hey, it worked!")

# Allowing necessary time to process email and message to be entered
time.sleep(1)

# Sending key and message to specified email
link = browser.find_element_by_id("emailBtn")
link.click()

# Closing browser
browser.close()

# Allowing time for email to be sent
time.sleep(1)

# Start of the email scrapping; Function to extract body from email


def get_body(msg):
    if msg.is_multipart():
        return get_body(msg.get_payload(0))
    else:
        return msg.get_payload(None, True)


# Connecting to server and logging in
con = imaplib.IMAP4_SSL(imap_url)
con.login(user, password)

# Searching through inbox for email from admin
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
email_key = email_array[22][:-1].decode("utf-8")

# Determining if email sent with modified message
if email_key == "worked":
    print("Test Passed")
else:
    print("Test did not pass")

# Closing connection to email
con.logout()
