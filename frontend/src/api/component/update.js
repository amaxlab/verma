import client from '@/api/client';

export default (id, {name, enabled}) => new Promise ((resolve, reject) => {
    client.put('/api/components/'+id, {name: name, enabled: enabled}).then(environment => {
        resolve(environment);
    }).catch(error => {
        reject(error);
    });
});
