<script>
    $(document).on("submit", ".ajaxform", function(e) {
        e.preventDefault();
        const attr = this.getAttribute("data-form");
        if (attr == "processing") {
            return false;
        }
        this.setAttribute("data-form", "processing");
        const form = e.currentTarget;
        const url = form.action;
        const method = form.getAttribute("method");
        const container = form
        try {
            const formData = new FormData(form);
            const response = fetch(url, {
                    method: method,
                    body: formData,
                    redirect: 'follow',
                    headers: {
                        "Accept": "application/json"
                    }
                }).then(async response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    }
                    let res = await response.json();
                    res["flag"] = response.ok;
                    this.setAttribute("data-form", "done");
                    return res
                })
                .then(response => {
                    if (!response.flag) {
                        const olderror = document.getElementsByClassName('text-danger small');
                        const olderrorArray = Array.from(olderror);
                        olderrorArray.forEach(oe => {
                            oe.remove();
                        });
                        const error_element = document.createElement("span");
                        error_element.setAttribute("class", "text-danger small")
                        error_element.setAttribute("role", "alert");
                        Object.keys(response.errors).forEach((input_name) => {
                            let new_input = input_name.split(".").map((val, i) => {
                                if (i == 0) {
                                    return val;
                                } else {
                                    return `[${val}]`
                                }
                            }).join('');
                            const elements = container.querySelectorAll(`[name='${new_input}']`);
                            if (elements.length > 0) {
                                element = elements[0]
                                response.errors[input_name].forEach(k => {
                                    const error_ele = error_element.cloneNode();
                                    error_ele.innerHTML = k;
                                    element.parentNode.insertBefore(error_ele, element.nextSibling);
                                    element.addEventListener("change", () => {
                                        error_ele.remove();
                                        element.removeEventListener("change");
                                    })
                                });
                            } else {
                                const elements = container.querySelectorAll(`[name='${new_input}[]']`);
                                if (elements.length > 0) {
                                    element = elements[0]
                                    response.errors[input_name].forEach(k => {
                                        const error_ele = error_element.cloneNode();
                                        error_ele.innerHTML = k;
                                        element.parentNode.insertBefore(error_ele, element.nextSibling);
                                        element.addEventListener("change", () => {
                                            error_ele.remove();
                                            element.removeEventListener("change");
                                        })
                                    });
                                } else {
                                    response.errors[input_name].forEach(k => {
                                        const error_ele = error_element.cloneNode();
                                        error_ele.innerHTML = k;
                                        container.querySelector("#errorlist").appendChild(error_ele);
                                    });
                                }
                            }
                        });
                        // const error_elements = document.createElement("p");
                        // error_elements.setAttribute("class", "text-danger small")
                        // error_elements.setAttribute("role", "alert");
                        // const error_elee = error_elements.cloneNode();
                        // error_elee.innerHTML = '------------------------------------------';
                        // container.querySelector("#errorlist").appendChild(error_elee);
                        // const error_elee2 = error_elements.cloneNode();
                        // error_elee2.innerHTML = response.message;
                        // container.querySelector("#errorlist").appendChild(error_elee2);
                    }
                });
        } catch (error) {
            console.error(error);
        }
        return false;
    });
</script>