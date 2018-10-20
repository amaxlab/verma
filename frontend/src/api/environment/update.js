import client from '@/api/client';

export default (id, {name, enabled}) => new Promise ((resolve, reject) => {
    client.put('/api/environments/'+id, {name: name, enabled: enabled}).then(environment => {
        resolve(environment);
    }).catch(error => {
        reject(error);
    });
});
