export function checkFormatExcel(selectedFile) {
    const allowedtypes = [
        "application/vnd.ms-excel",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        "application/vnd.ms-excel.sheet.macroEnabled.12",
    ];
    const maxsize = 2 * 1024 * 1024;
    if (selectedFile.size > maxsize) {
        throw "File anda lebih dari 2mb";
    } else if (!allowedtypes.includes(selectedFile.type)) {
        throw "File bukan berformat excel!";
    }
}
