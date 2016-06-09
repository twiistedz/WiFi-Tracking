<?php
namespace App\Model\Table;

use App\Model\Entity\MonitoringDevice;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MonitoringDevices Model
 *
 * @property \Cake\ORM\Association\HasMany $MonitoringDeviceLocations
 * @property \Cake\ORM\Association\HasMany $ReceivedRequests
 */
class MonitoringDevicesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('monitoring_devices');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('MonitoringDeviceLocations', [
            'foreignKey' => 'monitoring_device_id'
        ]);
        $this->hasMany('ReceivedRequests', [
            'foreignKey' => 'monitoring_device_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('mac_address', 'create')
            ->notEmpty('mac_address');

        return $validator;
    }
}