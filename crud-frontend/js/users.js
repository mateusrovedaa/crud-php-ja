const loadTable = () => {
    axios.get(`${ENDPOINT}/users`)
        .then((response) => {
            const data = response.data;
            var trHTML = '';
            data.forEach(element => {
                trHTML += `<tr>
                <td>${element.id}</td>
                <td>${element.name}</td>
                <td>${element.email}</td>
                <td><button type="button" class="btn btn-outline-secondary" onclick="showUserEditBox(${element.id})">Edit</button>
                <button type="button" class="btn btn-outline-danger" onclick="userDelete(${element.id})">Del</button></td>
                </tr>`;
            });
            document.getElementById("mytable").innerHTML = trHTML;
        })
};

loadTable();

const userCreate = () => {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;

    axios.post(`${ENDPOINT}/users`, {
        name: name,
        email: email
    })
        .then((response) => {
            Swal.fire(`User ${response.data.name} created`);
            loadTable();
        }, (error) => {
            Swal.fire(`Error to create user: ${error.response.data.error} `)
                .then(() => {
                    showUserCreateBox();
                })
        });
}

const getUser = (id) => {
    return axios.get(`${ENDPOINT}/users/` + id);
}

const userEdit = () => {
    const id = document.getElementById("id").value;
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;

    axios.put(`${ENDPOINT}/users/` + id, {
        name: name,
        email: email
    })
        .then((response) => {
            Swal.fire(`User ${response.data.name} updated`);
            loadTable();
        }, (error) => {
            Swal.fire(`Error to update user: ${error.response.data.error} `)
                .then(() => {
                    showUserEditBox(id);
                })
        });
}

const userDelete = async (id) => {
    const user = await getUser(id);
    const data = user.data;
    axios.delete(`${ENDPOINT}/users/` + id)
        .then(() => {
            Swal.fire(`User ${data.name} deleted`);
            loadTable();
        }, (error) => {
            Swal.fire(`Error to delete user: ${error.response.data.error} `);
            loadTable();
        });
};

const showUserCreateBox = () => {
    Swal.fire({
        title: 'Create user',
        html:
            `<input id="id" type="hidden">
            <label for="name" class="form-label">Name</label>
            <input id="name" class="swal2-input" placeholder="Name">
            <label for="name" class="form-label">Email</label>
            <input type="email" id="email" class="swal2-input" placeholder="Email">`,
        focusConfirm: false,
        showCancelButton: true,
        preConfirm: () => {
            userCreate();
        }
    });
}

const showUserEditBox = async (id) => {
    const user = await getUser(id);
    const data = user.data;
    Swal.fire({
        title: 'Edit User',
        html:
            `<input id="id" type="hidden" value="${data.id}">
            <label for="name" class="form-label">Name</label>
            <input id="name" class="swal2-input" placeholder="Name" value="${data.name}">
            <label for="name" class="form-label">Email</label>
            <input type="email" id="email" class="swal2-input" placeholder="Email" value="${data.email}">`,
        focusConfirm: false,
        showCancelButton: true,
        preConfirm: () => {
            userEdit();
        }
    });

}
