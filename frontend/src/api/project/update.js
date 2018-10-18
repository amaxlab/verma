import client from '@/api/client';

export default (id, {name, enabled}) => new Promise ((resolve, reject) => {
    client.put('/api/projects/'+id, {name: name, enabled: enabled}).then(project => {
        resolve(project);
    }).catch(error => {
        reject(error);
    });
});
