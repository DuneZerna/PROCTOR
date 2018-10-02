OC.L10N.register(
    "encryption",
    {
    "Missing recovery key password" : "Липсва парола за възстановяване",
    "Please repeat the recovery key password" : "Повтори новата парола за възстановяване",
    "Repeated recovery key password does not match the provided recovery key password" : "Повторената парола за възстановяване не съвпада със зададената парола за възстановяване",
    "Recovery key successfully enabled" : "Успешно включване на опцията ключ за възстановяване.",
    "Could not enable recovery key. Please check your recovery key password!" : "Неуспешно включване на опцията ключ за възстановяване. Моля, провери паролата за ключа за възстановяване.",
    "Recovery key successfully disabled" : "Успешно изключване на ключа за възстановяване.",
    "Could not disable recovery key. Please check your recovery key password!" : "Неуспешно изключване на ключа за възстановяване. Моля, провери паролата за ключа за възстановяване!",
    "Missing parameters" : "Липсват параметри",
    "Please provide the old recovery password" : "Моля, въведи старата парола за възстановяване",
    "Please provide a new recovery password" : "Моля, задай нова парола за възстановяване",
    "Please repeat the new recovery password" : "Моля, въведи повторна новата парола за възстановяване",
    "Password successfully changed." : "Паролата е успешно променена.",
    "Could not change the password. Maybe the old password was not correct." : "Грешка при промяна на паролата. Може би старата ти парола е сгрешена.",
    "Recovery Key disabled" : "Деактивиран ключ за възстановяване",
    "Recovery Key enabled" : "Активиран ключ за възстановяване",
    "Could not enable the recovery key, please try again or contact your administrator" : "Неуспешно активиране на ключ за въстановяване, моля, опитайте пак или се свържете с администратора",
    "Could not update the private key password." : "Неуспешна промяна на паролата на личния ключ",
    "The old password was not correct, please try again." : "Старата парола е грешна, опитай отново.",
    "The current log-in password was not correct, please try again." : "Грешна парола за вписване, опитай отново.",
    "Private key password successfully updated." : "Успешно променена тайната парола за ключа.",
    "You need to migrate your encryption keys from the old encryption (ownCloud <= 8.0) to the new one. Please run 'occ encryption:migrate' or contact your administrator" : "Трябва да мигрирате ключовете за криптиране от стария формат (ownCloud <= 8.0) до новия. Моля, изпълнете 'occ encryption:migrate' или се свържете с администратора",
    "Invalid private key for Encryption App. Please update your private key password in your personal settings to recover access to your encrypted files." : "Невалиден личен ключ за Криптиращата Програма. Моля, обнови личния си ключ в Лични настройки, за да възстановиш достъпа до криптираните си файловете.",
    "Encryption App is enabled and ready" : "Приложението за криптиране е активирано и готово",
    "Bad Signature" : "Грешен подпис",
    "Missing Signature" : "Липсва подпис",
    "one-time password for server-side-encryption" : "еднократна парола за сървърно криптиране",
    "Can not decrypt this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Неуспешно разшифроване на този файл, вероятно това е споделен файл. Моля, поискай собственика на файла да го сподели повторно с теб.",
    "Can not read this file, probably this is a shared file. Please ask the file owner to reshare the file with you." : "Неуспешно прочитане на този файл, вероятно това е споделен файл. Моля, помолете собственика на файла да го сподели повторно с Вас.",
    "Hey there,\n\nthe admin enabled server-side-encryption. Your files were encrypted using the password '%s'.\n\nPlease login to the web interface, go to the section 'ownCloud basic encryption module' of your personal settings and update your encryption password by entering this password into the 'old log-in password' field and your current login-password.\n\n" : "Здравейте,\n\nАдминистраторът активира сървърно криптиране. Файловете Ви са криптирани с паролата '%s'.\n\nМоля, впишете се в уеб интерфейъст, отидете в секцията 'ownCloud базов модол за криптиране' в личните настройки и променете паролата за криптиране въвеждайки тази парола в поелете 'стара парола за вписване' и текущата парола за вписване.\n",
    "The share will expire on %s." : "Споделянето ще изтече на %s.",
    "Cheers!" : "Поздрави!",
    "Hey there,<br><br>the admin enabled server-side-encryption. Your files were encrypted using the password <strong>%s</strong>.<br><br>Please login to the web interface, go to the section \"ownCloud basic encryption module\" of your personal settings and update your encryption password by entering this password into the \"old log-in password\" field and your current login-password.<br><br>" : "Здравейте,<br><br>Администраторът активира сървърно криптиране. Файловете Ви са криптирани с паролата '%s'.<br><br>Моля, впишете се в уеб интерфейъст, отидете в секцията 'Базов модул за криптиране на ownCloud' в личните настройки и променете паролата за криптиране въвеждайки тази парола в поелете 'стара парола за вписване' и текущата парола за вписване.<br><br>",
    "Encryption App is enabled but your keys are not initialized, please log-out and log-in again" : "Програмата за криптиране е включена, но твоите ключове не са зададени, моля отпиши си и се впиши отново.",
    "Encrypt the home storage" : "Криптиране на лоаклното дисково пространство",
    "Enabling this option encrypts all files stored on the main storage, otherwise only files on external storage will be encrypted" : "Активирането на тази опция ще криптира всички съхранени файлове на главното дисково пространство иначе само файлове на външно дисково пространство ще бъдат криптирани",
    "Enable recovery key" : "Активиране на ключ за възстановяване",
    "Disable recovery key" : "Деактивиране на ключ за възстановяване",
    "The recovery key is an extra encryption key that is used to encrypt files. It allows recovery of a user's files if the user forgets his or her password." : "Ключът за възстановяване е допълнителен ключ за криптиране, който се използва за криптиране на файлове. Той позволява възстановяването на потребителските файлове ако потребителят забрави своята парола.",
    "Recovery key password" : "Парола за възстановяане на ключа",
    "Repeat recovery key password" : "Повторете паролата на ключа за възстановяване",
    "Change recovery key password:" : "Промени паролата за въстановяване на ключа:",
    "Old recovery key password" : "Старата парола на ключа за възстановяване",
    "New recovery key password" : "Нова порола за ключа за възстановяване",
    "Repeat new recovery key password" : "Повтаряне на новата парола на ключа за възстановяване",
    "Change Password" : "Промени Паролата",
    "ownCloud basic encryption module" : "Базов модул за криптиране на ownCloud ",
    "Your private key password no longer matches your log-in password." : "Личният ти ключ не съвпада с паролата за вписване.",
    "Set your old private key password to your current log-in password:" : "Промени паролата за тайния ти включ на паролата за вписване:",
    " If you don't remember your old password you can ask your administrator to recover your files." : "Ако не помниш старата парола помоли администратора да възстанови файловете ти.",
    "Old log-in password" : "Стара парола за вписване",
    "Current log-in password" : "Текуща парола за вписване",
    "Update Private Key Password" : "Промени Тайната Парола за Ключа",
    "Enable password recovery:" : "Включи опцията възстановяване на паролата:",
    "Enabling this option will allow you to reobtain access to your encrypted files in case of password loss" : "Избирането на тази опция ще ти позволи да възстановиш достъпа си до файловете в случай на изгубена парола.",
    "Enabled" : "Включено",
    "Disabled" : "Изключено"
},
"nplurals=2; plural=(n != 1);");
