from selenium import webdriver
import time

# TODO: Need to put comments in code
# TODO: report errors

IP = '10.178.40.49'



val = input('Would you like to start testing? ')
while val != "no":

        url = 'http://' + IP + '/main/invite.html'
        browser = webdriver.Chrome()
        browser.get(url)
        generate = browser.find_element_by_id("generateKeyBtn")
        generate.click()
        time.sleep(2)

        link = browser.find_element_by_id("keyMsg")
        print("\n\n\nKey Generator Test Pass.")

        link.click()

        time.sleep(2)
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

        time.sleep(3)

        showPass = browser.find_element_by_id("box")
        showPass.click()

        time.sleep(7)

        submit = browser.find_element_by_id("submit")
        submit.click()

        time.sleep(1)

        user = browser.find_element_by_name("user")
        password = browser.find_element_by_name("pass")

        user.send_keys("snodderlyT")
        password.send_keys("snoddT@2019")

        time.sleep(2)

        submit = browser.find_element_by_id("submit")
        submit.click()

        time.sleep(7)

        browser.close()

        print("\n\n\nFull Client-Side Test Passed. \n" 
              "Signing in the user, and logging in the user.\n\n\n")


        url = 'http://' + IP + '/main/inc/test.php'
        browser = webdriver.Chrome()
        browser.get(url)

        time.sleep(12)

        browser.close()

        print("Server-side Test Passed.\n\n\n")


        url = 'http://' + IP + '/main/login.php'
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

        time.sleep(7)

        browser.close()

        print("Login Fail Test Passed.\n\n\n")
        break


