<section class="nav-admin">
    <div class="nav-admin__wrapper">
        <form method="POST">
            <button type="submit">Редактирования товара</button>
            <input  type="hidden" name="link" value="admin">
            <input  type="hidden" name="admin__panel" value="goods">
        </form>
        <form method="POST">
            <button type="submit">Пользователи</button>
            <input  type="hidden" name="admin__panel" value="users">
        </form>
        <form method="POST">
            <button type="submit">Статистика покупок</button>
            <input  type="hidden" name="admin__panel" value="static">
        </form>
    </div>
</section>