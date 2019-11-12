import consts


def login(user, userpass):
    url = consts.IP + "login.php"

    browser = consts.webdriver.Chrome()
    browser.get(url)

    # Finding by id username input
    username_test = browser.find_element_by_id("username")
    # passing creds to run function multpile times
    username_test.send_keys(user)

    # Finding by id username password
    password_test = browser.find_element_by_id("pass")
    password_test.send_keys(userpass)

    # Finding by id button to generate key
    generate = browser.find_element_by_id("submit")
    generate.click()

    browser.close()


login(consts.Admin_username, "gibberish")
login(consts.Admin_username, "gibberish")
login(consts.Admin_username, "gibberish")

print("Passed.")
