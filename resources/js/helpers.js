export function getLocalUser() {
    let user  = localStorage.getItem("user");
    if (!user) return null;
    return JSON.parse(user);
}
export function isAuthRequired(auth) {
    if (auth) return {
      AuthRequired:true
    };
    return {
      guest:true
    };
}
