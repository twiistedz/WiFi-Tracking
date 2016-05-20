<?php
namespace App\Model\Table;

use App\Model\Entity\ReceivedRequest;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReceivedRequests Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MonitoringDevices
 */
class ReceivedRequestsTable extends Table
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

        $this->table('received_requests');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('MonitoringDevices', [
            'foreignKey' => 'monitoring_device_id',
            'joinType' => 'INNER'
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
            ->requirePresence('tracked_mac_address', 'create')
            ->notEmpty('tracked_mac_address');

        $validator
            ->dateTime('request_timestamp')
            ->requirePresence('request_timestamp', 'create')
            ->notEmpty('request_timestamp');

        $validator
            ->integer('signal_strength')
            ->requirePresence('signal_strength', 'create')
            ->notEmpty('signal_strength');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['monitoring_device_id'], 'MonitoringDevices'));
        return $rules;
    }

    public function findRelatedReceivedRequests(Query $query, array $options) {
	    $sql_command = sprintf('
			SELECT *
			FROM funcGetReceivedRequests(%s)
			', $options['id']);
	    return $this->query($sql_command)->toArray();
    }
}
