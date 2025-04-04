export function clearField(field) {
    $(field).val("");
}
export function clearFields(fields) {
    fields.forEach((element) => {
        $(element).val("");
    });
}
