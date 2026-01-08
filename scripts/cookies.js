(() => {
    function parseCookieValue(value, fallback) {
        if (!value) {
            return fallback;
        }
        try {
            return JSON.parse(decodeURIComponent(value));
        } catch (error) {
            return fallback;
        }
    }

    function getCookieRaw(name) {
        const cookieString = document.cookie
            .split("; ")
            .find((row) => row.startsWith(name + "="));
        return cookieString ? cookieString.split("=").slice(1).join("=") : null;
    }

    function getCookieJson(name, fallback = []) {
        const value = getCookieRaw(name);
        return parseCookieValue(value, fallback);
    }

    function setCookieJson(name, value, days) {
        const expires = new Date();
        expires.setDate(expires.getDate() + days);
        document.cookie = `${name}=${encodeURIComponent(
            JSON.stringify(value)
        )}; expires=${expires.toUTCString()}; path=/`;
    }

    function deleteCookie(name) {
        document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
    }

    window.CookieUtils = {
        getCookieJson,
        setCookieJson,
        deleteCookie,
        parseCookieValue,
    };
})();
