import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:hooks_riverpod/hooks_riverpod.dart';
import 'package:itr/core/controllers/auth.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/widgets/primary_button.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class TinNIDScreen extends HookConsumerWidget {
  const TinNIDScreen({Key? key, required this.phoneNumber}) : super(key: key);

  final String phoneNumber;

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final formKey = useMemoized(() => GlobalKey<FormState>());
    final tinController = useTextEditingController();
    final nidController = useTextEditingController();

    return Container(
      decoration: const BoxDecoration(
        image: DecorationImage(
          image: AssetImage('assets/images/bg-gradient.jpg'),
          fit: BoxFit.cover,
        ),
      ),
      child: Scaffold(
        backgroundColor: Colors.transparent,
        appBar: const TransparentAppBar(),
        body: SafeArea(
          child: Padding(
            padding: const EdgeInsets.all(16.0),
            child: Form(
              key: formKey,
              child: ListView(
                children: [
                  Text(
                    AppLocalizations.of(context)!.enter_tin_n_nid_number,
                    style: Theme.of(context).textTheme.headline3,
                  ),
                  const SizedBox(height: 12),
                  Text(
                    AppLocalizations.of(context)!.to_begin_with_itr,
                    style: Theme.of(context).textTheme.subtitle2,
                  ),
                  const SizedBox(height: 40),
                  Text(
                    AppLocalizations.of(context)!.tin_number,
                    style: Theme.of(context).textTheme.titleMedium,
                  ),
                  const SizedBox(height: 8),
                  TextFormField(
                    controller: tinController,
                    keyboardType: TextInputType.number,
                    autovalidateMode: AutovalidateMode.onUserInteraction,
                    validator: (value) {
                      if (value?.trim().isEmpty ?? true) {
                        return 'This field is required';
                      }
                      try {
                        int.parse(value!.trim());
                      } catch (e) {
                        return 'Invalid value';
                      }
                      return null;
                    },
                  ),
                  const SizedBox(height: 12),
                  Text(
                    AppLocalizations.of(context)!.nid_number,
                    style: Theme.of(context).textTheme.titleMedium,
                  ),
                  const SizedBox(height: 8),
                  TextFormField(
                    controller: nidController,
                    keyboardType: TextInputType.number,
                    autovalidateMode: AutovalidateMode.onUserInteraction,
                    validator: (value) {
                      if (value?.trim().isEmpty ?? true) {
                        return 'This field is required';
                      }
                      try {
                        int.parse(value!.trim());
                      } catch (e) {
                        return 'Invalid value';
                      }
                      return null;
                    },
                  ),
                  const SizedBox(height: 20),
                  PrimaryButton(
                    onTap: () {
                      if (!(formKey.currentState?.validate() ?? false)) return;
                      ref
                          .read(authControllerProvider)
                          .register(
                            phoneNumber,
                            nidController.text.trim(),
                            tinController.text.trim(),
                          )
                          .then(
                        (result) {
                          if (result) {
                            Navigator.pushNamedAndRemoveUntil(
                              context,
                              Routes.home,
                              (route) => false,
                            );
                          }
                        },
                      );
                    },
                    text: AppLocalizations.of(context)!.start,
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}
