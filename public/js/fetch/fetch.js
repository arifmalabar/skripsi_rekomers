function showError(response) {
    return `Error : ${response.statusText} Error Code : ${response.status}`;
}
export async function getData(url) {
    const response = await fetch(url);
    if (response.ok && response.status == 200) {
        return response.json();
    } else {
        throw new Error(showError(response));
    }
}
export async function insertData(url, data, token) {
    const response = await fetch(url, {
        body: JSON.stringify(data),
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
    });
    if (response.ok && response.status == 200) {
        return response.json();
    } else {
        throw new Error(showError(response));
    }
}
export async function updateData(url, data, token) {
    const response = await fetch(url, {
        body: JSON.stringify(data),
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
    });
    if (response.ok && response.status == 200) {
        return response.json();
    } else {
        throw new Error(showError(response.json()));
    }
}
export async function deleteData(url, id, token) {
    const response = await fetch(`${url}/${id}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
    });
    if ((response.ok && response.status == 201) || response.status == 200) {
        return response.json();
    } else {
        throw new Error(showError(response));
    }
}
export async function deleteDataByCompact(url, data, token) {
    const response = await fetch(`${url}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
        body: JSON.stringify(data),
    });
    if ((response.ok && response.status == 201) || response.status == 200) {
        return response.json();
    } else {
        throw new Error(showError(response));
    }
}
