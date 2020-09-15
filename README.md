EIE4432 Group Project

1.  Please first run the '4432_db.sql' file into the mysql phpmyadmin database

2.  Testing account username & password are shown as the following:
        Admin:
            username: Admin
            password: Admin
        Seller:
            username: tests
            password: tests

            username: Renesas
            password: Renesas

            username: STMicroelectronics
            password: STMicroelectronics

            username: Acer
            password: Acer

            username: Apple
            password: Apple

            username: TexasInstruments
            password: TexasInstruments
            
        Buyer:
            username: testb
            password: testb

         Registration can be done to get a Seller account or a Buyer account.
         
3.  Testing credit card information are shown as the following:
        VISA
            Card Number:    4716108999716531
            Security Code:  257

        MasterCard
            Card Number:    5281037048916168
            Security Code:  043

        American Express
            Card Number:    342498818630298
            Security Code:  3156

4.  The currency is 'HKD' by default

5.  No any records of order made and categories clicked.
        The 'index.php' (Homepage) will auto change if there is record of categories inserted into the database
            'index.php' will change as the following
                Non-login user: The most click rate between the registrated user
                Logined user:   The most click rate of that user account