import create from './create';
import update from './update';
import deleteApi from './delete';
import setEnabled from './setEnabled';

const environment = {
    create: create,
    update: update,
    delete: deleteApi,
    setEnabled: setEnabled
};

export default environment
