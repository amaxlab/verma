import client from '@/api/client';

export default id => new Promise ((resolve, reject) => {
    client.delete('/api/environments/'+id).then(environment => {
        resolve(environment);
    }).catch(error => {
        reject(error);
    });
});
