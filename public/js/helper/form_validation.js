export function validateEmptyField(field) {
    if (field === "") {
        throw new Error("Field harus diisi");
    }
}
export function validateTrueFalseField(field1, field2) {
    if (field1 != field2) {
        throw new Error("Data tidak sama");
    }
}
