import client from '@/api/client';

export default (id, {name, enabled}) => new Promise ((resolve, reject) => {
    client.put('/api/users/'+id, {name: name, enabled: enabled}).then(user => {
        resolve(user);
    }).catch(error => {
        reject(error);
    });
});
