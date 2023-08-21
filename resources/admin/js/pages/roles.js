import JustValidate from 'just-validate';
import {Notyf} from 'notyf';
import 'notyf/notyf.min.css';

let bodyTable = document.getElementById('rolesTable').getElementsByTagName('tbody')[0];
let form = document.getElementById('roleForm');
let nameInput = document.getElementById('adminRoleName');

let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('roleModal'));
let labelModal = document.getElementById('roleModalLabel');

let deleteModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('roleModalDelete'));
let labelDeleteModal = document.getElementById('roleModalDelLabel');
let confirmDeleteButton = document.getElementById('deleteRole');
let deleteRoleId;

let createButton = document.getElementById('createButton');
let editButtons = document.querySelectorAll('td > a:first-child');
let deleteButtons = document.querySelectorAll('td > a:nth-child(2)');
let editRoleId;

const saveButton = document.getElementById('saveRole');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const CURRENT_URL = window.location.href;
const validator = new JustValidate('#roleForm', {
    errorLabelCssClass: 'mt-2',
    validateBeforeSubmitting: true,
});

validator
    .addField('#adminRoleName', [
        {
            rule: 'required',
        },
        {
            rule: 'minLength',
            value: 5,
        },
        {
            rule: 'maxLength',
            value: 50,
        },
    ]);

const notyf = new Notyf({
    duration: 3000,
    position: {
        x: 'right',
        y: 'top',
    }
});

saveButton.addEventListener('click', function (event) {
    if (event.detail > 1) {
        notyf.error("Don't click too fast.");
        return;
    }
    form.requestSubmit();
})

// create button
createButton.addEventListener('click', function (event) {
    labelModal.innerHTML = 'Create role';
    form.reset();
    form.removeEventListener('submit', update);
    form.addEventListener('submit', store);
    validator.refresh();
})

// edit button
editButtons.forEach(function (element) {
    addOnClickEdit(element);
})

function addOnClickEdit(element) {
    element.addEventListener('click', async function (event) {
        form.reset();
        form.removeEventListener('submit', store);
        form.addEventListener('submit', update);
        validator.refresh();

        const roleId = element.closest('tr').getAttribute('data-id');
        editRoleId = roleId;
        let url = CURRENT_URL + "/" + roleId;
        fetch(url)
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                labelModal.innerHTML = `Edit role <strong>${data.data?.name}</strong>`;
                nameInput.value = data.data?.name;
            })
    })
}

// store role
async function store() {
    if (!validator.isValid) {
        return;
    }
    try {
        const response = await fetch(CURRENT_URL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({name: nameInput.value}),
        });

        const result = await response.json();
        if (response.status === 201) {
            let row = bodyTable.insertRow();
            row.setAttribute('data-id', result.data?.id);
            row.setAttribute('data-name', result.data?.name);
            row.innerHTML = `<td>${result.data?.name}</td>
                                <td>
                                   <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#roleModal"><i class="align-middle" data-feather="edit-2"></i></a>
                                   <a href="#" data-bs-toggle="modal" data-bs-target="#roleModalDelete"><i class="align-middle" data-feather="trash-2"></i></a>
                                </td>`;
            feather.replace()
            modal.hide();
            addOnClickEdit(row.querySelector('td > a:first-child'));
            addOnClickDelete(row.querySelector('td > a:nth-child(2)'));
            // Display an error notification
            notyf.success('Create role successfully!');
        } else if (response.status === 422) {
            let errorMessages = result?.errors['name'].join('<br>')
            // Display an error notification
            notyf.error(errorMessages);
        }

    } catch (error) {
        console.error("Error:", error);
    }
}

// update role
async function update() {
    if (!validator.isValid) {
        return;
    }
    try {
        const response = await fetch(CURRENT_URL + '/' + editRoleId, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({name: nameInput.value}),
        });

        const result = await response.json();
        if (response.status === 200) {
            modal.hide();
            const row = document.querySelector(`tr[data-id="${editRoleId}"]`);
            row.setAttribute('data-name', result.data?.name);
            row.firstElementChild.innerHTML = result.data?.name;
            notyf.success('Update role successfully!');
        } else if (response.status === 422) {
            let errorMessages = result?.errors['name'].join('<br>')
            // Display an error notification
            notyf.error(errorMessages);
        } else {
            notyf.error(result.message);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}

// edit button
deleteButtons.forEach(function (element) {
    addOnClickDelete(element)
});

function addOnClickDelete(element) {
    element.addEventListener('click', function (event) {
        labelDeleteModal.innerHTML = `Delete role <strong>${element.closest('tr').getAttribute('data-name')}</strong>`;
        deleteRoleId = element.closest('tr').getAttribute('data-id');
    })
}

confirmDeleteButton.addEventListener('click', async function (event) {
    await fetch(CURRENT_URL + '/' + deleteRoleId, {
        method: 'DELETE',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        }
    }).then((response) => {
        if (response.status === 204) {
            const row = document.querySelector(`tr[data-id="${deleteRoleId}"]`);
            row.remove();
            deleteModal.hide();
            notyf.success('Deleted role successfully!');
        }
    });
});
