import React, { useState } from 'react'

import { Link, router } from '@inertiajs/react'

export default function Create({ store_url }) {

    const [data, setData] = useState({
        name: '',
        address: '',
    })

    function handleChange(e) {
        const key = e.target.id
        const value = e.target.value

        setData(data => ({
            ...data,
            [key]: value
        }))
    }

    function handleSubmit(e) {
        e.preventDefault()
        router.post(store_url, data)
    }

    return (
        <>
            <div className="p-8 rounded border border-gray-200">
                <h1 className="font-medium text-3xl">Add Property</h1>
                <form onSubmit={handleSubmit}>
                    <div className="mb-6">
                        <label htmlFor="name" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                        <input id="name" onChange={handleChange} value={data.name} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    </div>
                    <div className="mb-6">
                        <label htmlFor="address" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address:</label>
                        <input id="address" onChange={handleChange} value={data.address} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
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
