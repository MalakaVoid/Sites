$( document ).ready(function() {

    $.ajax({
        type: "POST",
        url: "/admin/handlers/get_users.php",
        dataType: "json",
        success: function (response) {
            for (let user of response.data) {

                let row_el = `
                    <tr>
                        <td>${user['user_id']}</td>
                        <td>${user['login']}</td>
                        <td>${user['password']}</td>
                        <td>${user['first_name']}</td>
                        <td>${user['last_name']}</td>
                        <td>${user['email']}</td>
                        <td>${user['is_admin']}</td>
                        <td><form action='/admin/edit_user.php' method='POST'><button type='submit' name='user_id' value='${user['user_id']}'><img src='../images/edit.png'></button></form></td>
                        <td><button class="delete_btn" value=${user['user_id']}><img src='../images/bin.png'></button></td>
                    </tr>
                `;
                console.log(row_el);
                $('#users_table').append(row_el);
            }
        }
    });

});