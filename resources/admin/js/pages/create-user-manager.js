import JustValidate from 'just-validate';
const validator  = new JustValidate('#userManagerForm',{
    errorLabelCssClass: 'mt-2',
    validateBeforeSubmitting: true,
});

validator
    .addField('#adminEmail', [
        {
            rule: 'required',
        },
        {
            rule: 'email',
        }
    ])
    .addField('#adminName', [
        {
            rule: 'required',
        }
    ])
    .addField('#adminPassword', [
        {
            rule: 'required',
        },
        {
            rule: 'strongPassword'
        },

    ],
        {
            errorsContainer: document.querySelector('.password-group'),
        })
    .addField('#adminPasswordConfirmation', [
        {
            rule: 'required',
        },
        {
            validator: (value, fields) => {
                if (
                    fields['#adminPassword'] &&
                    fields['#adminPassword'].elem
                ) {
                    const repeatPasswordValue =
                        fields['#adminPassword'].elem.value;

                    return value === repeatPasswordValue;
                }

                return true;
            },
            errorMessage: 'Passwords confirmation should be the same',
        },
    ])
    .addRequiredGroup(
        '#rolesGroup',
        'You should select at least one role.'
    )
    .onSuccess((event) => {
        document.getElementById("userManagerForm").submit();
    });
