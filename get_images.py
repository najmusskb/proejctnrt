import urllib.request
import json

places = [
    "Colosseum", "Vatican Museums", "Trevi Fountain", "Pantheon, Rome",
    "Roman Forum", "St. Peter's Basilica", "Spanish Steps", "Palatine Hill",
    "Piazza Navona", "Florence", "Venice", "Amalfi", "Positano", "Eiffel Tower",
    "Swiss Alps", "Acropolis of Athens", "Sistine Chapel"
]

results = {}

for place in places:
    try:
        url = f"https://en.wikipedia.org/w/api.php?action=query&titles={urllib.parse.quote(place)}&prop=pageimages&format=json&pithumbsize=800"
        req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
        response = urllib.request.urlopen(req)
        data = json.loads(response.read().decode())
        pages = data['query']['pages']
        for page_id in pages:
            if 'thumbnail' in pages[page_id]:
                results[place] = pages[page_id]['thumbnail']['source']
            else:
                results[place] = "NO IMAGE"
    except Exception as e:
        results[place] = str(e)

with open("urls.json", "w") as f:
    json.dump(results, f, indent=4)
print("Done")
