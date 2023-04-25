import countries from 'world-countries';

export function useCountries()
{

    const formatCountries = countries.map((country) => ({
        id: country.cca2,
        label: country.name.common,
        flag: country.flag,
        latlng: country.latlng,
        region: country.region,
    }));

    const getAll = () => formatCountries;

    const getByValue = (value) =>
    {
        return formatCountries.find((item) => item.value === value);
    }

    return { getAll, getByValue }

}
