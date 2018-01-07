<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Verkoo\Common\Entities\Contact;
use Verkoo\Common\Entities\Customer;
use Verkoo\Common\Entities\Supplier;

class ContactsController extends ApiController
{
    public function index()
    {
        $all = collect();
        $pushToAll = function ($collection) use ($all) {
            $all->push([
                'name' => $collection->name,
                'phone' => $collection->phone,
                'phone2' => $collection->phone2,
            ]);
        };

        Contact::searchByName()->get()->each(function ($contact) use ($all) {
            $all->push($contact);
        });
        Customer::searchByName()->get()->each($pushToAll);
        Supplier::searchByName()->get()->each($pushToAll);
        return $all;
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);

        Contact::create(request()->all());

        return $this->respond(['success' => true]);
    }

    public function update(Contact $contact)
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);
        $contact->update(request()->all());

        return $this->respond(['success' => true]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return $this->respond(['success' => true]);
    }
}