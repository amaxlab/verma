import client from '@/api/client';

export default id => new Promise ((resolve, reject) => {
    client.delete('/api/users/'+id).then(user => {
        resolve(user);
    }).catch(error => {
        reject(error);
    });
});
