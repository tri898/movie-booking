import JustValidate from 'just-validate';
const validator  = new JustValidate('#userManagerForm',{
    errorLabelCssClass: 'mt-2 form-text',
    validateBeforeSubmitting: true,
});

validator
    .addField('#adminName', [
        {
            rule: 'required',
        },
        {
            rule: 'maxLength',
            value: 100,
        }
    ])
    .addField('#adminPassword', [
        {
            rule: 'strongPassword'
        },

    ],
        {
            errorsContainer: document.querySelector('.password-group'),
        })
    .addField('#adminPasswordConfirmation', [
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
