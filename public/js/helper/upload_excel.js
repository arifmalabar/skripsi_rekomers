export async function uploadExcel(rfile) {
    let data = [];
    try {
        const arrayBuffer = await rfile.arrayBuffer();
        const workbook = XLSX.read(arrayBuffer, { type: "array" });
        const sheetName = workbook.SheetNames[0];
        const worksheet = workbook.Sheets[sheetName];
        data = XLSX.utils.sheet_to_json(worksheet, { header: 1 });
    } catch (error) {
        throw Error(error);
    }
    return data;
}
