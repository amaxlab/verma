import client from '@/api/client';

export default data => new Promise ((resolve, reject) => {
    client.post('/api/users', data).then(user => {
        resolve(user);
    }).catch(error => {
        reject(error);
    });
});
