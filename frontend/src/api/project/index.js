import create from './create';
import get from './get';
import deleteApi from './delete';
import update from './update';
import setEnabled from './setEnabled';

const project = {
    create: create,
    get: get,
    delete: deleteApi,
    update: update,
    setEnabled: setEnabled
};

export default project;
