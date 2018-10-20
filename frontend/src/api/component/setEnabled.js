import client from '@/api/client';

export default (id, enabled) => new Promise ((resolve, reject) => {
    client.put('/api/components/'+id, {enabled: enabled}).then(environment => {
        resolve(environment);
    }).catch(error => {
        reject(error);
    });
});
