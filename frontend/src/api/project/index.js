import create from './create';
import get from './get';
import deleteApi from './delete';
import setEnabled from './setEnabled';

const project = {
    create: create,
    get: get,
    delete: deleteApi,
    setEnabled: setEnabled
};

export default project;
