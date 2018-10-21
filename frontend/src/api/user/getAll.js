import client from '@/api/client';

export default () => new Promise ((resolve, reject) => {
    client.get('/api/users').then(users => {
        resolve(users);
    }).catch(error => {
        reject(error);
    });
});
