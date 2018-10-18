import client from '@/api/client';

export default id => new Promise ((resolve, reject) => {
    client.delete('/api/projects/'+id).then(project => {
        resolve(project);
    }).catch(error => {
        reject(error);
    });
});
