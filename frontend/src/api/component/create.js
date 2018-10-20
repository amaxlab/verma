import client from '@/api/client';

export default data => new Promise ((resolve, reject) => {
    client.post('/api/components', data).then(project => {
        resolve(project);
    }).catch(error => {
        reject(error);
    });
});
