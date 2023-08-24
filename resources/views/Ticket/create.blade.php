<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<div>
    <form action="{{ Route('requests.store') }}" method="post" enctype="application/x-www-form-urlencoded"
          style="display: grid; gap: 20px;">
        <label for="name">Имя пользователя</label>
        <input name="name" type="text">
        <label for="email">Электронная почта</label>
        <input name="email" type="email">
        <label for="message">Сообщение</label>
        <textarea name="message" type="text"></textarea>
        <button type="submit">Отправить</button>
    </form>
</div>
