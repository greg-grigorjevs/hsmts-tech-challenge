import React from 'react'

import { Link, useForm } from '@inertiajs/react'
import { Property } from '@/types';

export default function Create({ property, store_url }: {property: Property, store_url: string}) {

    const {data, setData, post, errors} = useForm({
        name: '',
        size: 20.0,
        property_id: property.id
    });


    function handleChange(e: React.FormEvent<HTMLInputElement>) {
        const key = e.currentTarget.id
        const value = e.currentTarget.value

        setData(data => ({
            ...data,
            [key]: value
        }))
    }

    function handleSubmit(e: React.SyntheticEvent) {
        e.preventDefault()
        post(store_url)
    }


    return (
        <>
            <div className="p-8 rounded border border-gray-200">
                <h1 className="font-medium text-3xl">Add New Room to Property</h1>
                <form onSubmit={handleSubmit}>
                    <div className="mb-6">
                        <label htmlFor="name" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                        <input id="name" onChange={handleChange} value={data.name} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    </div>
                    <div className="mb-6">
                        <label htmlFor="address" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size:</label>
                        <input id="address" type="number" step="0.1" onChange={handleChange} value={data.size} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    </div>

                    <div>
                        <input type="submit" className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" />
                        <Link href='/property' as="button" className="ml-2 border border-gray-300 hover:bg-gray-100 rounded-lg font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center">Cancel</Link>
                    </div>
                </form>
            </div>

        </>

    );
}
