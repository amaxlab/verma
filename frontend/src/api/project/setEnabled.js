import client from '@/api/client';

export default (id, enabled) => new Promise ((resolve, reject) => {
    client.put('/api/projects/'+id, {enabled: enabled}).then(project => {
        resolve(project);
    }).catch(error => {
        reject(error);
    });
});
