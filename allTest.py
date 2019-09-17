from selenium import webdriver
import time
import imaplib
import email

# TODO: Need to put comments in code
# TODO: report errors

#IP address for working enviroment
IP = '10.178.40.49/branch/MJM-Tax-Services'

#Variable for email of client and password
user_email = 'testing.mjm.services@gmail.com'
password_email = 'pioiamrcvstfdtik'

#user input to start test, every answer but no will start the test
val = input('Would you like to start testing? ')
while val != "no":

        print("\n\n*****\n")
        print("Starting unit test for generating registration key.\n")
        print("*****\n\n\n")

        #Going to url to generate key.
        url = 'http://' + IP + '/invite.php'
        #Opening web browser, for user gratification
        browser = webdriver.Chrome()
        browser.get(url)
        #Finding the generate key button, and proceding to click the button
        generate = browser.find_element_by_id("generateKeyBtn")
        generate.click()


        email_reg = browser.find_element_by_name("email")
        email_reg.send_keys(user_email)

        email_click = browser.find_element_by_id("emailBtn")
        email_click.click()

        browser.close()

        print("\n\n*****\n")
        print("Email Has been sent. Test Passed.\n")
        print("*****\n\n\n")

        print("\n\n*****\n")
        print("Starting Email Scraping Test.\n")
        print("*****\n\n\n")

        #Necessary sleep time to allow for key to be generated.
        #time.sleep(15)

        #Start of email scraping key test
        imap_url = 'imap.gmail.com'

        #Function to extract body from email
        def get_body(msg):
                if msg.is_multipart():
                        return get_body(msg.get_payload(0))
                else:
                        return msg.get_payload(None, True)

        #Connecting to server and logging in
        con = imaplib.IMAP4_SSL(imap_url)
        con.login(user_email, password_email)
        #Searching through inbox for email from admin
        con.select('INBOX')
        result, data = con.search(None, '(FROM "testing.mjm.services@gmail.com")')
        email_list = data[0].split()

        oldest = email_list[-1]

        #Converting email to string from bytes
        result, data = con.fetch(oldest, '(RFC822)')
        raw = email.message_from_bytes(data[0][1])

        email_msg = get_body(raw)


        #Taking message from string to array to parse through to find necessary index of word
        email_array = email_msg.split()

        #print(email_array[14])

        #print(email_array[14][:-1].decode("utf-8"))

        email_key = email_array[14][:-1].decode("utf-8")

        #Logging out of connection
        con.logout()

        print("\n\n*****\n")
        print("Email Scrapping Test Passed.\n")
        print("*****\n\n\n")
        #End of email scrapping key test

        print("\n\n*****\n")
        print("Starting New User Registration Test.\n")
        print("*****\n\n\n")

        # Going to url to generate key.
        url = "http://" + IP + "/signup.php?key=" + email_key
        # Opening web browser, for user gratification
        browser = webdriver.Chrome()
        browser.get(url)

        time.sleep(2)
        #Finding elements to insert test variables
        fname = browser.find_element_by_name("fname")
        lname = browser.find_element_by_name("lname")
        user = browser.find_element_by_name("user")
        email = browser.find_element_by_name("email")
        password = browser.find_element_by_name("pass")
        passVerif = browser.find_element_by_name("passVerif")
        phoneNum = browser.find_element_by_name("phoneNum")
        street = browser.find_element_by_name("street")
        city = browser.find_element_by_name("city")
        state = browser.find_element_by_name("state")
        zip = browser.find_element_by_name("zip")
        #regKey = browser.find_element_by_name("key")
        q1 = browser.find_element_by_id("1")
        a1 = browser.find_element_by_name("sec_ans_1")
        q2 = browser.find_element_by_id("2")
        a2 = browser.find_element_by_name("sec_ans_2")
        q3 = browser.find_element_by_id("3")
        a3 = browser.find_element_by_name("sec_ans_3")

        #Insert variables to test the creation of an account
        fname.send_keys("Tyler")
        lname.send_keys("Snodderly")
        user.send_keys("snodderlyT")
        email.send_keys("tyler.snodderly@myemail.indwes.edu")
        password.send_keys("snoddT@2019")
        passVerif.send_keys("snoddT@2019")
        phoneNum.send_keys("123-456-7890")
        street.send_keys("1234 E Driver's Lane")
        city.send_keys("Marion")
        state.send_keys("IN")
        zip.send_keys("46953")
        #regKey.send_keys(registrationKey)
        q1.send_keys("w")
        a1.send_keys("a1")
        q2.send_keys("W")
        a2.send_keys("a2")
        q3.send_keys("W")
        a3.send_keys("a3")

        #time.sleep(3)

        #Testing the show password function
        showPass = browser.find_element_by_id("box")
        showPass.click()

        time.sleep(1)

        #Submitting Client creation form
        submit = browser.find_element_by_id("submit")
        submit.click()

        time.sleep(1)

        browser.close()

        print("\n\n*****\n")
        print("New User Registration Test Passed.\n")
        print("*****\n\n\n")

        #Start of test to sign in created user
        print("***\n")
        print("Start of test for signing in newly created user.\n")
        print("***\n\n\n")

        # Going to url to generate key.
        url = "http://" + IP + "/login.php"
        # Opening web browser, for user gratification
        browser = webdriver.Chrome()
        browser.get(url)

        #Finding elements to input created user
        user = browser.find_element_by_name("user")
        password = browser.find_element_by_name("pass")

        user.send_keys("snodderlyT")
        password.send_keys("snoddT@2019")

        time.sleep(2)

        submit = browser.find_element_by_id("submit")
        submit.click()

        time.sleep(2)

        browser.close()

        print("***\n")
        print("New User login Passed.\n")
        print("***\n")
        print("\n\n\nFull Client-Side Test Passed.\n\n\n")


        #Server Side Testing
        """url = 'http://' + IP + '/inc/test.php'
        browser = webdriver.Chrome()
        browser.get(url)

        time.sleep(12)

        browser.close()

        print("Server-side Test Passed.\n\n\n")"""

        print("***\n")
        print("Start of wrong user name and password.\n")
        print("***\n\n\n")

        url = 'http://' + IP + '/login.php'
        browser = webdriver.Chrome()
        browser.get(url)

        time.sleep(2)

        user = browser.find_element_by_name("user")
        password = browser.find_element_by_name("pass")

        user.send_keys("*yhfwjkf")
        password.send_keys("78*&Tifwl")

        time.sleep(2)

        submit = browser.find_element_by_id("submit")
        submit.click()

        time.sleep(2)

        browser.close()

        print("Login Fail Test Passed.\n\n\n")
        break
