# =========== #
# ATOMO THEME #
# =========== #

LANG_DIR=languages
LANG_POT=$(LANG_DIR)/atomo.pot
LANG_SRC=$(wildcard *.php inc/*.php *.html)


all:

.PHONY: messages
messages: $(LANG_DIR)/atomo.pot $(LANG_DIR)/de_DE.po $(LANG_DIR)/es_CL.po

$(LANG_DIR)/atomo.pot: $(LANG_SRC)
	xgettext --join-existing --from-code=UTF-8 --keyword=__ --keyword=_e --keyword=_n --keyword=_s --no-wrap --language=PHP --copyright-holder=OQGraphic --package-name=Atomo --add-comments --sort-output -o $(LANG_POT) *.{html,php} inc/*.php

$(LANG_DIR)/de_DE.po: $(LANG_POT) $(LANG_SRC)
	[ -f $@ ] && msgmerge --no-wrap -o $@ $@ $< || msginit --input=$< --output=$@ --locale=de --no-translator --no-wrap

$(LANG_DIR)/es_CL.po: $(LANG_POT) $(LANG_SRC)
    [ -f $@ ] && msgmerge --no-wrap -o $@ $@ $< || msginit --input=$< --output=$@ --locale=es --no-translator --no-wrap

.PHONY: translations
translations: $(LANG_DIR)/de_DE.mo $(LANG_DIR)/es_CL.mo

$(LANG_DIR)/de_DE.mo: $(LANG_DIR)/de_DE.po
	msgfmt --output-file=$@ $<
$(LANG_DIR)/es_CL.mo: $(LANG_DIR)/es_CL.po
	msgfmt --output-file=$@ $<
