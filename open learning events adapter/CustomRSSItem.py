from PyRSS2Gen import PyRSS2Gen

class CustomRSSItem(PyRSS2Gen.RSSItem):
    def __init__(self,
                 title = None,  # string
                 link = None,   # url as string
                 description = None, # string
                 author = None,      # email address as string
                 categories = None,  # list of string or Category
                 comments = None,  # url as string
                 enclosure = None, # an Enclosure
                 guid = None,    # a unique string
                 pubDate = None, # a datetime
                 source = None,  # a Source
                 customItems = None, #custom rss fields
                 ):
        
        PyRSS2Gen.RSSItem.__init__(self, title,link,description,author,categories,comments,enclosure,guid,pubDate,source)
        self.customItems = customItems
        
    def publish_extensions(self, handler):
        for key, value in self.customItems.items():
            PyRSS2Gen._opt_element(handler, key, value)