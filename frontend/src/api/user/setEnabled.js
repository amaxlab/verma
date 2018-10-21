import client from '@/api/client';

export default (id, enabled) => new Promise ((resolve, reject) => {
    client.put('/api/users/'+id, {enabled: enabled}).then(user => {
        resolve(user);
    }).catch(error => {
        reject(error);
    });
});
