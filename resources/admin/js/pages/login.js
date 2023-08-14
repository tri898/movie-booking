import JustValidate from 'just-validate';
const validator  = new JustValidate('#login-form',{
    errorLabelCssClass: 'mt-2',
    validateBeforeSubmitting: true,
});

validator
    .addField('#login-email', [
        {
            rule: 'required',
        },
        {
            rule: 'email',
        },
    ])
    .addField('#login-password', [
        {
            rule: 'required',
        },
        {
            rule: 'strongPassword',
        },
    ])
    .onSuccess((event) => {
        document.getElementById("login-form").submit();
    });
