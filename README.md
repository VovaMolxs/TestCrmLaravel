## Тестовое задание согласно следующему ТЗ
1) Создать небольшую црм систему по управлению компаниями и её сотрудниками. Будет один пользователь (администратор) который может создавать компании и добавлять в них сотрудников.
1) Реализовать базовую авторизацию (вход по логин и паролю).
2) Администратора создать с помощь сидеров с данными для входа (Логин: admin  Пароль: q12345)
3) Создать миграции для компаний: name, email, phone, website, logo (путь к файлу с логотипом), note
4) Создать миграции для сотрудников компании: first name, last name, company_id, email, phone, note
5) Создать CRUD (Create, Read, Update, Delete) для компаний и сотрудников. Создание и редактирование реализовать с помощью Ajax
6) Для создания CRUD-ов нужно применить Laravel resource маршруты
7) Для валидации использовать Request классы
8) Реализовать экспорт таблиц с компаниями и сотрудниками в Excel
9) Применить в проекте библиотеку Datatables
10) Использовать AdminLTE тему в качестве фронденда
11) Сделать мультиязычное приложение (Русский и английский язык)

## Что сделано и не сделано согласно тз:
- сделано все согласно ТЗ
- над дизайном не заморачивался сильно
- валидация данных простая. По уму надо делать ее еще и на фронте
- есть проблема по поводу роутингов. При обновлении данных(формы с картинкой) при отправке на сервер, запрос формируется хорошо со всеми токенами и данными, но реквест на сервере пустой, что бы решить эту проблему создал отдельный метод и прокинул на него роут и все заработало. Думаю если бы это делалось не асинхронно проблемы такой не было. Очень интересно как можно решить этот вопрос отправляя запрос на стандартный метод update реквест класса. У меня не вышло. А так в целом все норм, дополнительно сделал два роутинга для того чтобы получать сотрудников и компании асинхронно.
- если удаляем фирму, сотрудников не удалял, сделать чтобы удалялись не сложно.(в миграция изначально задать удаление). При удалении у сотрудников в поле компания остаятся null.
- прикладываю видео работы crm <a href='https://www.veed.io/view/0acdd36e-9587-4ee7-a0a2-3765477de1b3?sharingWidget=true&panel=share' >Видео работы</a>


- ниже пометки, если вдруг будет проблема с авторизацией после подтягивания зависимостей.
## Пометки
Правка в vendor\laravel\ui\auth-backend\AuthenticatesUsers
метод username() меняем return 'email' на return 'name' чтобы при авторизации не вводить email

Правка в vendor\laravel\ui\auth-backend\RedirectsUsers
после авторизация указываю путь в админку
