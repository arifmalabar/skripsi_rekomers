export async function getData(url) {
    try {
        const response = await fetch(url);
        switch (response.status) {
            case 200:
                const data = await response.json();
                return data;
                break;
            case 400:
                const error = await response.json();
                throw new Error(error);
                break;
            default:
                throw new Error(await response.status);
                break;
        }
    } catch (error) {
        alert(error);
    }
}
export async function getDetailData(url, id) {
    try {
        const response = await fetch(`${url}/${id}`);
        switch (response.status) {
            case 200:
                const data = await response.json();
                return data;
                break;
            case 400:
                const error = await response.json();
                throw new Error(error);
                break;
            default:
                throw new Error(await response.status);
                break;
        }
    } catch (error) {
        alert(error);
    }
}
export async function deleteData(url, id) {
    try {
        const response = await fetch(`${url}/${id}`, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": window.data.token,
            },
            method: "DELETE",
        });
        switch (response.status) {
            case 200:
                const data = await response.json();
                return data;
                break;
            case 400:
                const error = await response.json();
                throw new Error(error);
                break;
            default:
                throw new Error(await response.status);
                break;
        }
    } catch (error) {
        alert(error);
    }
}
export async function postData(url, data) {
    try {
        const response = await fetch(url, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": window.data.token,
            },
            body: JSON.stringify(data),
            method: "POST",
        });
        switch (response.status) {
            case 201:
                const data = await response.json();
                return data;
                break;
            case 400:
                const error = await response.json();
                throw new Error(error);
                break;
            default:
                throw new Error(await response.status);
                break;
        }
    } catch (error) {
        alert(error);
    }
}
export async function updateData(...params) {
    try {
        const response = await fetch(`${params[0]}/${params[2]}`, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $(".csrf").val(),
            },
            body: JSON.stringify(params[1]),
            method: "PUT",
        });
        switch (response.status) {
            case 200:
                const data = await response.json();
                return data;
                break;
            case 400:
                const error = await response.json();
                throw new Error(error);
                break;
            default:
                throw new Error(await response.status);
                break;
        }
    } catch (error) {
        alert(error);
    }
}
export async function showResponse(response) {
    switch (await response.status) {
        case 200:
            const data = await response.json();
            return data;
            break;
        case 400:
            const error = await response.json();
            throw new Error(error);
            break;
        default:
            throw new Error(await response.status);
            break;
    }
}
